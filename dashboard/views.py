import json

from django import http
from django.shortcuts import render
from django.template import loader

from . import models
import scraper
import requests
from constants import *

# Create your views here.
def index(request):

    matches = []
    for data in scraper.scrape("event/2016chcmp"):
        matches.append(model.Match.load(data))
    
    context = {"matches": matches}
    return render(request, "dashboard/index.html", context)

def scrape(request):

    if REQUEST in request.GET:
        return http.HttpResponse(json.dumps(scraper.scrape(request.GET[REQUEST])))
    else:
        return http.HttpResponse("No request specified")
