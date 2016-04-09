from .__init__ import *

def pr(path: str, prefix: str=PREFIX) -> dict:
    event = path.split("/")[1]
    data = scrape("event/" + event)
    matches = scrape("event/" + event + "/matches")
    teams = [team["key"] for team in scrape("event/" + event + "/teams")]

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
