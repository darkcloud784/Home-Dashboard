# Home Dashboard

Home dashboard is a homelab dashboard with qBittorrent, Transmission, and forecast.io integration.

## Installation

Extract to your webserver and create a "bookmarks.dat" file in the root direcotry. Edit the config.php file and fill in the necessary information.
The time display is based on your php settings. Set the timezone in your php.ini file.

Requirements: PHP 5.x

## Bookmarks
Bookmarks must be set in the "bookmarks.dat" file. Here's an example:

    [qBittorrent]
	url=https://192.168.0.0:8080
	icon=icon_cloud-download_alt
	iframe=true
	
	[Plex]
	url=https://192.168.0.0:32400/web/index.html
	icon=arrow_triangle-right_alt2
	iframe=false

**Leave a blank line between each definition.**
* url: The url you wish to reach
 * icon: The icon of the bookmark, available icons are displayed here: https://www.elegantthemes.com/blog/resources/elegant-icon-font, Look under "Complete List Of Class Names".
 * iframe: Can be true or false. "True" will open the page in the current window while "false" will open it in a new tab. You may encounter problem with "true" as some softwares won't allow loading in an iframe. Sometimes, you just need to visit the page once to accept the self-signed certificate.

## Grafana dashlets
Grafana dashlets can be added through the dashlets.php file. Just add the URL provided by grafana. You can find the URL by going to your dashboard, selecting your dashlet and going to "share". From there, just copy the URL from the embed tab excluding the iframe/width/height/frameboarder section. Be sure that if you want a dynamically updating dashlet to uncheck the current time range.
Paste the link inside the URL part of the dashlet.php, more than one dashlet can be entered. You can also change the width and height of each dashlet as you please.

This Home Dashboard was built using:
* [Nice admin template](http://bootstraptaste.com/nice-admin-bootstrap-admin-html-template/?download=true)
* [tobias redmann's forecast.io php api](https://github.com/tobias-redmann/forecast.io-php-api)
* [darkskyapp's Skycons](https://github.com/darkskyapp/skycons)

## Screenshots
![Not found](/screenshots/home.PNG?raw=true "Home")
![Not found](/screenshots/dashlets.PNG?raw=true "Grafana")
![Not found](/screenshots/sidenav_open.PNG?raw=true "Side Open")
![Not found](/screenshots/plex.PNG?raw=true "Plex")



** Special thanks **
Special thanks to Gabisonfire for making his dashboard, as mine was inspired by his. I would also like to thank him for letting me use some of his code.

## License
Distributed under the MIT License.

THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY, FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM, OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN THE SOFTWARE.
