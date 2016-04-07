# Multipurpose scoutmaster scraper

# Imports
import os, sys
sys.path.append(os.path.abspath(".."))
import requests
import json

# Basic headers
HEADERS = {"Host": "www.thebluealliance.com", "X-TBA-App-Id": "frc449:scout:0"}
PREFIX = "http://www.thebluealliance.com/api/v2/"

# Scrape
def scrape(path: str, prefix: str=PREFIX) -> dict:
    """Scrape a data entry from Blue Alliance API.

    :parameter url: the path of the data to access.
    :parameter prefix: by default, the URL to the API.

    Automatically includes the initial part of the URL unless otherwise
    specified by prefix.
    """

    url = os.path.join(prefix, path)

    # Send the request
    response = requests.get(url, headers=HEADERS)

    # If the response is valid, return the contents
    if response.status_code == 200:
        return json.loads(response.content.decode())

    # Otherwise, return None
    return None

import pprint
pprint.pprint(scrape("event/2016chcmp"))
