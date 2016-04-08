function scrape(path, callback) {
    var request = new XMLHttpRequest();
    var url = "/scout/scrape?request=" + path;
    request.open("GET", url, true);
    request.onreadystatechange = function() {
        if (request.readyState == 4 && request.status == 200) {
            var data = JSON.parse(request.responseText);
            callback(data);
        }
    }
    request.send();
}

function scrapeAll(paths, callback) {
    var responses = {}
    callback = callback;
    for (i in Object.keys(paths)) {
        var request = new XMLHttpRequest();
        request.name = Object.keys(paths)[i];
        request.path = paths[request.name];
        var url = "/scout/scrape?request=" + request.path;
        request.open("GET", url, true);
        request.onreadystatechange = function() {
            if (this.readyState == 4) {
                if (this.status == 200) {
                    try {
                        responses[this.name] = JSON.parse(this.responseText);
                    } catch(error) {}
                } else {
                    responses[this.name] = null;
                }
                for (i in Object.keys(paths)) {
                    if (!responses.hasOwnProperty(Object.keys(paths)[i])) return;
                }
                callback(responses);
            }
        }
        request.send();
    }
}

function sorted(list, key) {
    keys = []; map = {}; out = [];
    for (var i in list) { keys.push(list[i][key]); map[list[i][key]] = list[i]; }
    if (!isNaN(keys[0])) keys.sort(function(a, b) { return a - b; });
    else keys.sort();
    for (var i in keys) out.push(map[keys[i]]);
    return out;
}

function getCurrentEvent(events) {
    var now = new Date();
    var i = 0;
    var next = events[0];
    while (i < events.length) {
        var event = events[i];
        var end = new Date(event.end_date.replace("-", "/").replace("-", "/"));
        if (now < end) next = event;
        i++;
    }
    var end = new Date(next.end_date.replace("-", "/").replace("-", "/"));
    if (now > end) next = null;
    return next;
}

function getCurrentMatch(matches) {
    var now = new Date();
    var i = 0;
    var next = matches[0];
    while (i < matches.length) {
        var match = matches[i];
        var start = new Date(match.time*1000);
        next = match;
        if (now < start) break;
        i++;
    }
    return next;
}

function getLastMatch(matches) {
    var now = new Date();
    var i = 0;
    var last = matches[0];
    while (i < matches.length) {
        var match = matches[i];
        var start = new Date(match.time*1000);
        if (now < start) break;
        last = match;
        i++;
    }
    return last;
}

function getMatches(event, team) {
    var data = scrape("event/" + event + "/matches");
    if (team !== undefined) var matches = scrape("team/" + team + "/event/" + event + "/matches");
    else var matches = scrape("event/" + event + "/matches");
    return sorted(matches, "match_number");
}

function getRanking(rankings, team) {
    var result = [];
    for (var i in rankings) if (rankings[i][1] == team.substring(3)) result = rankings[i]; 
    var map = {};
    for (var i in rankings[0]) map[rankings[0][i]] = result[i];
    return map;
}

