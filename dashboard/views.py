from django import http
from django.shortcuts import render
from django.template import loader
from . import model

import scraper
import requests

# Create your views here.
def index(request):

    matches = []
    for (data in scraper.scrape("event/2016chcmp")):
        matches.append(model.Match.load(data))
    
    context = {"matches": matches}
    return render(request, "dashboard/index.html", context)

