const YEAR = String(new Date().getFullYear());

const API = "https://www.thebluealliance.com/api/v2/"
const TEAM = "team/{0}";
const EVENTS = "team/{0}/{1}/events";
const MATCHES = "event/{0}/matches";

if (!String.prototype.format) {
    String.prototype.format = function() {
        var args = arguments;
        return this.replace(/{(\d+)}/g, function(match, number) { 
            return typeof args[number] != 'undefined' ? args[number] : match;
        });
    };
}

function date(string) {
    let split = string.split("-");
    return new Date(split[0], split[1]-1, split[2]);
}

function scrape(path) {
    return new Promise(function(resolve, reject) {
        let url = API + path;
        let request = new XMLHttpRequest();
        request.open("GET", url, true);
        request.setRequestHeader("X-TBA-App-Id", "frc449:scout:v1");
        //request.setRequestHeader("Host", "www.thebluealliance.com");
        request.onreadystatechange = function() {
            if (this.state < 200 || this.status >= 300) {
                reject({status: this.status, statusText: this.statusText});
            } else if (this.readyState == 4) {
                resolve(JSON.parse(this.responseText));
            } 
        };
        request.onerror = function () {
            reject({status: this.status, statusText: this.statusText});
        };
        request.send();
    });
}

function getTeam(number) { 
    return new Promise(function(resolve, reject) {
        scrape(TEAM.format("frc" + number)).then(function(team) {
            resolve(team);
        }).catch(function(error) { reject(error); });
    });
}

function getYear() { return YEAR; }

function getCurrentEvent(team) {
    return new Promise(function(resolve, reject) {
        scrape(EVENTS.format(team.key, YEAR)).then(function(events) {
            let now = new Date();
            let today = new Date(now.getFullYear(), now.getMonth(), now.getDate());
            for (let i = 0; i < events.length; i++) {
                let last = events[i-1] && date(events[i-1].start_date) || 0;
                let end = date(events[i].end_date);
                if (last <= today && today <= end) {
                    resolve(events[i]);
                    break;
                }
            }
            resolve(null);
        }).catch(function(error) { reject(error); });
    });
}

function getEventMatches(event) {
    return new Promise(function(resolve, reject) {
        scrape(MATCHES.format(event.key)).then(function(matches) {
            matches.sort(function(a, b) { return a.match_number - b.match_number; });
            resolve(matches);
        }).catch(function(error) { reject(error); });
    });
}

function getNextMatchIndex(matches) {
    for (let i = 0; i < matches.length; i++) {
        let now = new Date();
        let last = i > 0 ? new Date(matches[i-1].time * 1000) : new Date(0);
        let next = new Date(matches[i].time * 1000);
        if (last < now && now <= next) {
            return i;
        }
    }
}

function getFirstUnscoredMatchIndex(matches) {
    for (let i = 0; i < matches.length; i++) {
        if (matches[i].alliances.red.score < 0 || matches[i].alliances.blue.score < 0) {
            return i;
        }
    }
}

function getTeamMatches(team, matches) {
    let filtered = [];
    for (let i = 0; i < matches.length; i++) {
        let teams = matches[i].alliances.red.teams + matches[i].alliances.blue.teams;
        if (teams.indexOf(team.key) > 0) {
            filtered.push(matches[i]);
        }   
    }
    return filtered;
}
