const NUMBER = 449;
const E = {
    "team": null,
    "event": null,
    "clock": null,
    "date": null,
    "matches": null,
    "schedule": null,
    "info": null,
    "next": null,
}

for (let id in E)
    E[id] = document.getElementById(id); 

var team;
var event;
var matches;

var selection = -1;
var rows = {};

getTeam(NUMBER).then(function(t) {
    team = t;
    E.team.innerHTML = team.nickname || "FRC Team " + team.team_number;
    getCurrentEvent(team).then(function(e) {
        event = e;
        E.event.innerHTML = event.event_type_string + " - " + event.short_name;
        //insertStream(e);
        start();
    });
});

function updateMatches() {
    getEventMatches(event).then(function(m) {
        rows = {};
        matches = m;
        E.matches.innerHTML = "";
        for (let i = 0; i < matches.length; i++) {
            let row = formatMatch(matches[i]);
            E.matches.appendChild(row);
            rows[matches[i].match_number] = row;
        }
        
        if (selection > -1)
            viewMatch(selection);
        
        let nextScheduled = matches[getNextMatchIndex(matches)];
        let firstUnscored = matches[getFirstUnscoredMatchIndex(matches)];
        let delay = formatDifferenceTime(new Date(nextScheduled.time*1000), new Date(firstUnscored.time*1000));
        E.schedule.innerHTML = "";
        E.schedule.innerHTML += "Next scheduled match: {0}<br>".format(nextScheduled.match_number);
        E.schedule.innerHTML += "Next actual match: {0}<br>".format(firstUnscored.match_number);
        E.schedule.innerHTML += "Approximate delay: {0}<br>".format(delay);
        
        viewMatch(firstUnscored.match_number);
        let nextTeam = nextUnscoredTeamMatch();
        E.next.innerHTML = matchSummary(nextTeam);
        E.next.innerHTML += "Matches until: " + (nextTeam.match_number - firstUnscored.match_number) + "<br>";
        E.next.innerHTML += "Approximate time: " + formatDifferenceTime(new Date(nextTeam.time*1000), new Date(firstUnscored.time*1000));
        
    }).catch(function(e) { console.error(e); });
}

COMPETITION_LEVEL = {"qm": "Qualifier", "ef": "Eliminations", "qf": "Quarter Finals", "sf": "Semi Finals", "f": "Finals"}

function nextUnscoredTeamMatch() {
    let teamMatches = getTeamMatches(team, matches);
    return teamMatches[getFirstUnscoredMatchIndex(teamMatches)];
}

function viewMatch(number) {
    let row = rows[number];
    let match = row.match;
    row.scrollIntoView();
    E.info.innerHTML = matchSummary(match);
}

function matchSummary(match) {
    let out = "";
    out += "<h3>" + COMPETITION_LEVEL[match.comp_level] + " Match #" + match.match_number + "</h3>";
    //out += "Time until: " + formatDifferenceTime(new Date(), new Date(match.time*1000)) + "<br>";
    out += "Red: <span class=\"red\">" + formatAlliance(match.alliances.red.teams) + "</span><br>";
    out += "Blue: <span class=\"blue\">" + formatAlliance(match.alliances.blue.teams) + "</span><br>";
    return out;
}

function insertStream(event) {
    let iframe = document.createElement("iframe");
    iframe.width = "640";
    iframe.height = "360";
    iframe.frameborder = "0";
    iframe.scrolling = "no";
    iframe.src = ("https://livestream.com/accounts/" + event.webcast[0].channel +
                  "/events/" + event.webcast[0].file + "/player?width=640&height=360&enableInfoAndActivity=true&defaultDrawer=&autoPlay=true&mute=false");
    document.body.appendChild(iframe);
}

function start() {

    updateMatches();
    setInterval(updateMatches, 30*1000);

    setInterval(function() {
        let now = new Date();
        E.clock.innerHTML = formatDigitalTime(now, true);
        E.date.innerHTML = formatDigitalDate(now);
    }, 500);

}




function formatMatch(match) {
    let row = document.createElement("tr");
    row.innerHTML += "<td>" + match.match_number + "</td>";
    row.innerHTML += "<td class=\"time\">" + formatDigitalTime(new Date(match.time*1000)) + "</td>";
    row.innerHTML += "<td><span class=\"red\">" + formatAlliance(match.alliances.red.teams) + "</span></td>";
    row.innerHTML += "<td><span class=\"blue\">" + formatAlliance(match.alliances.blue.teams) + "</span></td>";
    row.match = match;
    row.onclick = function() { 
        selection = this.match.match_number;
        viewMatch(this.match.match_number); 
    };
    if (match.alliances.red.teams.indexOf(team.key) > -1 || match.alliances.blue.teams.indexOf(team.key) > -1)
        row.style.backgroundColor = "lightblue";
    return row;
}

function formatAlliance(alliance) {
    return alliance.map(function(key) {
        number = key.substr(3); 
        if (team.key == key)
            return "<b>" + number + "</b>";
        return number;
    }).join(", ");
}

function twoDigit(string) {
    return ("00" + string).substr(-2);
}

function formatDigitalTime(date, seconds) {
    let out = twoDigit(date.getHours()) + ":" + twoDigit(date.getMinutes());
    if (seconds === true) out += ":" + twoDigit(date.getSeconds());
    return out;
}

function formatDigitalDate(date) {
    let out = ["Sunday", "Monday", "Tuesday", "Wednesday", "Thursday", "Friday", "Saturday"][date.getDay()];
    out += ", " + date.getFullYear() + "-" + (date.getMonth() + 1) + "-" + date.getDate();
    return out;
}

function formatDifferenceTime(date1, date2) {
    minutes = Math.abs(date2 - date1) / (60*1000);
    hours = Math.floor(minutes / 60);
    minutes = Math.floor(minutes % 60);
    return hours + ":" + twoDigit(minutes);
}

