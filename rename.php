<?php
#bundle import does not work.
echo "Company Part of Namespace: ";
$company = ucfirst(trim(fgets(STDIN)));
printLine("Company: " . $company);

echo "Package name of Namespace: ";
$package = ucfirst(trim(fgets(STDIN)));

$folder1 = $company;
$folder2 = $package;

printLine("Package: " . $package);
$currentBundleDirectory = __DIR__ . "/src/CyCoders/Bundle/WatchOnlineBundle";
$finalBundleDirectory = __DIR__ . '/src/' . $folder1 . '/Bundle/' . $folder2 . 'Bundle';
mkdir($finalBundleDirectory, 755, true);
system("rsync -av $currentBundleDirectory/ $finalBundleDirectory/");

$oldNamespace = "CyCoders\\Bundle\\WatchOnlineBundle";
$newNamespace = "$folder1\\Bundle\\{$folder2}Bundle";

$new_snail_case_name = from_camel_case("$folder1$folder2");

$files = getDirContents($finalBundleDirectory);

$bundleName = "{$folder1}{$folder2}Bundle";
$bundleNameShort = "{$folder1}{$folder2}";
foreach ($files as $file)
{
    if (!is_dir($file))
    {
        $fileContents = file_get_contents($file);

        $fileContents = str_replace($oldNamespace, $newNamespace, $fileContents);
        $fileContents = str_replace('cy_coders_watch_online', $new_snail_case_name, $fileContents);
        $fileContents = str_replace('CyCodersWatchOnlineBundle', $bundleName, $fileContents);
        $fileContents = str_replace('CyCodersWatchOnline', $bundleNameShort, $fileContents);
        file_put_contents($file, $fileContents);
    }
}

$bundleFilename = $finalBundleDirectory . "/$bundleName.php";
rename($finalBundleDirectory . "/CyCodersWatchOnlineBundle.php", $bundleFilename);

//Replace class name

file_put_contents(
    $bundleFilename,
    str_replace('CyCodersWatchOnlineBundle', $bundleName, file_get_contents($finalBundleDirectory . "/$bundleName.php"))
);


file_put_contents(
    "app/config/config.yml",
    str_replace('CyCodersWatchOnlineBundle', $bundleName, file_get_contents("app/config/config.yml"))
);

file_put_contents(
    "app/config/routing.yml",
    str_replace('CyCodersWatchOnlineBundle', $bundleName, file_get_contents("app/config/routing.yml"))
);

file_put_contents(
    "app/config/routing.yml",
    str_replace('cy_coders_watch_online', $bundleName, file_get_contents("app/config/routing.yml"))
);

$appKernelOldName = __DIR__ . '/app/AppKernel.php';
$appKernelNewName = __DIR__ . '/app/AppKernel.php';
//$appKernelNewName = __DIR__ . '/app/AppKernel.php.new';

$appKernelOldContent = file_get_contents($appKernelOldName);
$appKernelNewContent = str_replace($oldNamespace, $newNamespace, $appKernelOldContent);

$appKernelNewContent = str_replace('CyCodersWatchOnlineBundle', $bundleName, $appKernelNewContent);
file_put_contents($appKernelNewName, $appKernelNewContent);

function printLine($text = "")
{
    print $text . "\n";
}

function getDirContents($dir, &$results = array())
{
    $files = scandir($dir);

    foreach ($files as $key => $value)
    {
        $path = realpath($dir . DIRECTORY_SEPARATOR . $value);
        if (!is_dir($path))
        {
            $results[] = $path;
        }
        else if ($value != "." && $value != "..")
        {
            getDirContents($path, $results);
            $results[] = $path;
        }
    }

    return $results;
}

function from_camel_case($input)
{
    preg_match_all('!([A-Z][A-Z0-9]*(?=$|[A-Z][a-z0-9])|[A-Za-z][a-z0-9]+)!', $input, $matches);
    $ret = $matches[0];
    foreach ($ret as &$match)
    {
        $match = $match == strtoupper($match) ? strtolower($match) : lcfirst($match);
    }
    return implode('_', $ret);
}


print "All Done. To clean up run: \n\nrm -f rename.php ; rm -rf src/CyCoders; rm -rf .idea/ ; rm -rf .git/ ; git init .";
print "\n\n";
?>