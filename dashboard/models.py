from django.db import models

RED = "red"
BLUE = "blue"
SCORE = "score"
TEAMS = "teams"
ALLIANCES = "alliances"
BREAKDOWN = "score_breakdown"
NUMBER = "match_number"
TIME = "time"

# Create your models here.
class Team(models.Model):

    identifier = models.CharField(max_length=8)

    @classmethod
    def load(cls, identifier):
        return cls(identifier=identifier)

    def __str__(self):
        return self.identifier[3:]

class Alliance(models.Model):

    color = models.CharField(max_length=4)
    teams = models.CharField(max_length=24)
    score = models.IntegerField()

    @classmethod
    def load(cls, color, data):
        self.color = color
        self.teams = data[TEAMS]
        self.score = data[SCORE]
        
    @property
    def teams(self):
        return ", ".join(map(str, self.teams))

def Alliances(data):
    alliances = {}
    alliances[BLUE] = Alliance(data[BLUE])
    alliances[RED] = Alliance(data[RED])

class Match(models.Model):

    level = models.CharField(max_length=8)
    number = models.IntegerField()
    time = models.IntegerField()

    @classmethod
    def load(cls, data):
        self.alliances = Alliances(data[ALLIANCES])
        self.breakdown = data[BREAKDOWN]
        self.level = data[LEVEL]
        self.number = data[NUMBER]
        self.time = data[TIME]

    def __init__(self, data):
        self.alliances = {}
