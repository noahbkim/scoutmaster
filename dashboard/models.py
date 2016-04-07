from django.db import models

RED = "red"
BLUE = "blue"
SCORE = "score"
TEAMS = "teams"
ALLIANCES = "alliances"
BREAKDOWN = "score_breakdown"
NUMBER = "match_number"
TIME = "time"
LEVEL = "comp_level"

# Create your models here.
class Team(models.Model):

    number = models.IntegerField()

    @classmethod
    def load(cls, identifier):
        self = cls()
        self.number = int(identifier[3:])
        return self

    def __str__(self):
        return str(self.number)

class Alliance(models.Model):

    color = models.CharField(max_length=4)
    score = models.IntegerField()
    teams = []

    @classmethod
    def load(cls, color, data):
        self = cls()
        self.color = color
        self.teams = list(map(Team.load, data[TEAMS]))
        self.score = data[SCORE]
        return self

    def __str__(self):
        return ", ".join(map(str, self.teams))


def Alliances(data):
    alliances = {}
    alliances[BLUE] = Alliance.load(BLUE, data[BLUE])
    alliances[RED] = Alliance.load(RED, data[RED])
    return alliances;


class Match(models.Model):

    level = models.CharField(max_length=8)
    number = models.IntegerField()
    time = models.IntegerField()

    @classmethod
    def load(cls, data):
        self = cls()
        self.alliances = Alliances(data[ALLIANCES])
        self.breakdown = data[BREAKDOWN]
        self.level = data[LEVEL]
        self.number = data[NUMBER]
        self.time = data[TIME]
        return self

    @property
    def red(self):
        return str(self.alliances[RED])

    @property
    def blue(self):
        return str(self.alliances[BLUE])
