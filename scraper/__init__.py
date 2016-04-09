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

    if path.endswith("/pr"):
        return pr(path)
    
    response = raw(path, prefix=prefix)
    if response:
        return json.loads(response)

    # Otherwise, return None
    return None

def pr(path: str, prefix: str=PREFIX) -> dict:
    event = path.split("/")[1]
    data = scraper.scrape("event/" + event)
    matches = scraper.scrape("event/" + event + "/matches")
    teams = [team["key"] for team in scraper.scrape("event/" + event + "/teams")]

    matrix = numpy.zeros([len(teams), len(teams)])
    points_for = numpy.zeros([len(teams), 1])
    points_against = numpy.zeros([len(teams), 1])

    for match in matches:
        if match["alliances"]["red"]["score"] == -1 and match["alliances"]["blue"]["score"] == -1 or match["comp_level"] != "qm":
            continue

        for a in match["alliances"]["red"]["teams"]:
            y = teams.index(a)
            for b in match["alliances"]["red"]["teams"]:
                x = teams.index(b)
                matrix[y, x] += 1

            points_for[y, 0] += match["alliances"]["red"]["score"]
            points_against[y, 0] += match["alliances"]["blue"]["score"]

        for a in match["alliances"]["blue"]["teams"]:
            y = teams.index(a)
            for b in match["alliances"]["blue"]["teams"]:
                x = teams.index(b)
                matrix[y, x] += 1

            points_for[y, 0] += match["alliances"]["blue"]["score"]
            points_against[y, 0] += match["alliances"]["red"]["score"]

    opr = numpy.linalg.solve(matrix, points_for)
    dpr = numpy.linalg.solve(matrix, points_against)

    out = {}
    for i in range(len(teams)):
        out[teams[i]] = {"opr": opr[i, 0], "dpr": dpr[i, 0]}

    return out
