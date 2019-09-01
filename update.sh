#!/bin/sh
bzip2 -c9k ./Packages > ./Packages.bz2
printf "Origin: KidsAuto IOS Repo 8\nLabel: KidsAuto IOS Repo 8\nSuite: stable\nVersion: 1.0\nCodename: ios\nArchitecture: iphoneos-arm\nComponents: main\nDescription: KidsAuto iOS for Device Model 10.x - 12.2 & 12.4\nMD5Sum:\n "$(cat ./Packages | md5 | cut -d ' ' -f 1)" "$(stat -f%z ./Packages)" Packages\n "$(cat ./Packages.bz2 | md5 | cut -d ' ' -f 1)" "$(stat -f%z ./Packages.bz2)" Packages.bz2\n" >Release;
exit 0
