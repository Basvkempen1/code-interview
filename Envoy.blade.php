@servers(['testing'=>'tstbackoffice@213.214.121.168', 'staging' => 'stgbackoffice@213.214.121.168', 'production' => 'prdbackoffice@intbikes-web-p01.sc.nines.nl'])

@setup

    $folder_root            = '~';
    $max_releases           = 3;

    $folders['deploy']      = ['unique' => false, 'path' => $folder_root . '/deploy'];
    $folders['current']     = ['unique' => false, 'path' => $folders['deploy']['path'] . '/current_release'];
    $folders['shared']      = ['unique' => false, 'path' => $folders['deploy']['path'] . '/shared'];
    $folders['releases']    = ['unique' => false, 'path' => $folders['deploy']['path'] . '/releases'];
    $folders['new']         = ['unique' => true,  'path' => $folders['releases']['path'] . '/' . $buildNr];
    $folders['nodePath']    = ['unique' => true,  'path' => $folder_root . '/node-v14.18.1-linux-x64/bin:/sbin:/bin:/usr/sbin:/usr/bin'];
    $folders['npmPath']     = ['unique' => true,  'path' => $folder_root . '/node-v14.18.1-linux-x64/bin/npm'];

    $sharedFolders = ['storage'];
    $sharedFiles = ['.env', 'public/opcache.php'];



    if($server === 'production') {
        $servers = ['production'];
    } else if($server === 'staging') {
        $servers = ['staging'];
    } else {
        $servers = ['testing'];
    }


@endsetup

@story('deploy', ['on' => $servers])
    sanityChecks
    code
    sharedFiles
    tasks
    npm_setup
    symlinking
    cleanup
@endstory

@task('sanityChecks')
    echo 'Sanity checks started';

@foreach($folders as $folder)
    @if($folder['unique'] === false)
        [ -d {{$folder['path']}} ] && { echo "{{$folder['path']}} already exists"; } || { mkdir {{$folder['path']}}; echo "{{$folder['path']}} created!"; };
    @else
        [ -d "{{$folder['path']}}" ] && { echo "FATAL_ERROR: {{$folder['path']}} already exist so something is wrong!. This is on non-reusable folder"; exit 1; }
    @endif
@endforeach

    echo 'Sanity checks completed';
@endtask

@task('code')
    echo 'Code deploy started';
    [ -d {{$folders['new']['path']}} ] || { mkdir {{$folders['new']['path']}}; echo "{{$folders['new']['path']}} created"; };
    cd  {{$folders['new']['path']}};
    git clone {{$repo}} .;
    git checkout {{$commit}};
    echo 'Deploy completed';
@endtask

@task('tasks')
    echo 'Starting tasks';
    cd {{$folders['new']['path']}};
    /usr/bin/php81 /usr/local/bin/composer install --optimize-autoloader --no-dev
    /usr/bin/php81 artisan config:cache;
    /usr/bin/php81 artisan cache:clear;
    /usr/bin/php81 artisan route:clear;
    /usr/bin/php81 artisan view:cache;
{{--    /usr/bin/php80 artisan migrate --force;--}}
    /usr/bin/php81 artisan queue:restart;
    /usr/bin/php81 artisan storage:link;
    echo 'Finished tasks';
@endtask

@task('npm_setup')
    echo 'Starting npm setup';
    export PATH={{$folders['nodePath']['path']}}
    cd {{$folders['new']['path']}}
    {{$folders['npmPath']['path']}} install;
    {{$folders['npmPath']['path']}} run production;
@endtask

@task('sharedFiles')
    echo 'Linking shared files and folders';
    cd {{$folders['new']['path']}}
    @foreach($sharedFiles as $file)
        ln -sfn {{$folders['shared']['path']}}/{{$file}} {{$folders['new']['path']}}/{{$file}};
    @endforeach
    @foreach($sharedFolders as $folder)
        ln -sfn {{$folders['shared']['path']}}/{{$folder}} {{$folders['new']['path']}}/{{$folder}};
    @endforeach
@endtask

@task('symlinking')
    echo 'Symlinking started';
    cd {{$folders['deploy']['path']}};
    echo "Symlinking {{$folders['new']['path']}} to {{$folders['current']['path']}}";
    rm -rf {{$folders['current']['path']}} && ln -sfn {{$folders['new']['path']}} {{$folders['current']['path']}};
    echo 'Symlinking completed';
@endtask

@task('cleanup')
    cd {{$folders['releases']['path']}};
    ls -t | tail -n +{{$max_releases+1}} | xargs rm -R --
@endtask

@error
    exit('ERROR');
    echo "Error during task $task. Deploy did not finish!";
    exit;
@enderror
