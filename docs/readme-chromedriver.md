### Chromedriver
#### https://sites.google.com/chromium.org/driver/downloads?authuser=0
####

```
https://chromedriver.storage.googleapis.com/102.0.5005.61/chromedriver_mac64.zip
unzip chromedriver_mac64.zip
./chromedriver --version

### Install current version google-chrome and compatible chromedriver
## https://chromedriver.chromium.org/downloads/version-selection

# Install google-chrome
apt-get update
# installing dependencies for google-chrome If the chrome version will change we need update versions for dependencies
apt-get install fonts-liberation libatk-bridge2.0-0 libatk1.0-0 libatspi2.0-0 libdrm2 libgbm1 libgtk-3-0 libpango-1.0-0 libxcomposite1 libxdamage1 libxfixes3 libxkbcommon0 libxrandr2 libxshmfence1 xdg-utils -y
wget -q https://dl.google.com/linux/direct/google-chrome-stable_current_amd64.deb
dpkg -i --force-depends google-chrome-stable_current_amd64.deb
rm -f google-chrome-stable_current_amd64.deb

# get compatible version for chromedriver
VERSION_SHORT_CHROME=`echo "$(google-chrome --version)" | sed 's|[^0-9\.]||g;s|\.[0-9]*$||'`
wget -q https://chromedriver.storage.googleapis.com/LATEST_RELEASE_"$VERSION_SHORT_CHROME"
VERSION_CHROMEDRIVER=$(<LATEST_RELEASE_"$VERSION_SHORT_CHROME")
rm -f LATEST_RELEASE_"$VERSION_SHORT_CHROME"

# Install chromedriver
wget -N https://chromedriver.storage.googleapis.com/"$VERSION_CHROMEDRIVER"/chromedriver_linux64.zip -P ~/
unzip ~/chromedriver_linux64.zip -d ~/
mv -f ~/chromedriver /usr/local/bin/chromedriver
chmod 0755 /usr/local/bin/chromedriver
```
