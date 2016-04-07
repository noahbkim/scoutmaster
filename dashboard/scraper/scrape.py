import requests
import sys

HEADERS = {
    "Accept": "text/html,application/xhtml+xml,application/xml;q=0.9,image/webp,*/*;q=0.8",
    "Accept-Encoding": "gzip, deflate, sdch",
    "Accept-Language": "en-US,en;q=0.8",
    "Cache-Control": "max-age=0",
    "Connection": "keep-alive",
    "Cookie": "__cfduid=dc27251d815b4125f2836bb67dcdf30d71460039605; tba-gameday-last-login-prompt=1460039812112; __utma=100286555.1507267620.1460039609.1460039609.1460039912.2; __utmb=100286555.1.10.1460039912; __utmc=100286555; __utmz=100286555.1460039912.2.2.utmcsr=google|utmccn=(organic)|utmcmd=organic|utmctr=(not%20provided)",
    "Host": "www.thebluealliance.com",
    "Upgrade-Insecure-Requests": "1",
    "User-Agent": "Mozilla/5.0 (Macintosh; Intel Mac OS X 10_11_3) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/49.0.2623.110 Safari/537.36",
    "X-TBA-App-Id": "frc449:scout:0"
}

url = "http://www.thebluealliance.com/api/v2/team/frc449"
if len(sys.argv) > 1: url = sys.argv[1]

request = requests.get(url, headers=HEADERS)
print(request.content.decode())
