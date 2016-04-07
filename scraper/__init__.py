# Multipurpose scoutmaster scraper

# Imports
import os
import requests
import json

from constants import *

# Basic headers
HEADERS = {"Host": "www.thebluealliance.com", "X-TBA-App-Id": "frc449:scout:0"}
PREFIX = "http://www.thebluealliance.com/api/v2/"

# Scrape
def get(path: str, prefix: str=PREFIX) -> requests.Request:

    url = os.path.join(prefix, path)

    # Send the request
    return requests.get(url, headers=HEADERS)
    

def raw(path: str, prefix: str=PREFIX) -> str:
    
    response = get(path, prefix=prefix)

    # If the response is valid, return the contents
    if response.status_code == 200:
        return response.content.decode()

    return None

def scrape(path: str, prefix: str=PREFIX) -> dict:
    """Scrape a data entry from Blue Alliance API.

    :parameter url: the path of the data to access.
    :parameter prefix: by default, the URL to the API.

    Automatically includes the initial part of the URL unless otherwise
    specified by prefix.
    """
    
    response = raw(path, prefix=prefix)
    if response:
        return json.loads(response)

    # Otherwise, return None
    return None
