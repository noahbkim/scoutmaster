function scrape(path) {
    // Create the request
    var request = new XMLHttpRequest();
    var url = "/scout/scrape?request=" + path;
    // Send the request
    request.open("GET", url, false);
    request.send();
    // Process the request
    if (request.readyState == 4 && request.status == 200) {
        var data = JSON.parse(request.responseText);
        return data;
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

function getCurrentEvent(team) {
    // Now
    var now = new Date(Date.now());
    // Get the list of events
    data = scrape("team/" + team + "/" + now.getFullYear() + "/events");
    // Start with the first event
    var i = 0;
    var next = data[0];
    while (i < data.length) {
        var event = data[i];
        var end = new Date(event.end_date.replace("-", "/").replace("-", "/"));
        if (now < end) next = event;
        i++;
    }
    // If it's past the last match, return null
    var end = new Date(next.end_date.replace("-", "/").replace("-", "/"));
    if (now > end) next = null;
    // Return
    return next;
}

function getMatches(event, team) {
    var data = scrape("event/" + event + "/matches");
    if (team !== undefined) var matches = scrape("team/" + team + "/event/" + event + "/matches");
    else var matches = scrape("event/" + event + "/matches");
    return sorted(matches, "match_number");
}

function getRanking(event, team) {
    var data = scrape("event/" + event + "/rankings");
    var result = [];
    for (var i in data) if (data[i][1] == team.substring(3)) result = data[i]; 
    var map = {};
    for (var i in data[0]) map[data[0][i]] = result[i];
    return map;
}