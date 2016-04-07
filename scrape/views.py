from django import http
from django.shortcuts import render
from constants import *

import scraper

# Create your views here.
def scrape(request):
    if REQUEST in request.GET:
        return http.HttpResponse(scraper.raw(request.GET[REQUEST]))
    else:
        return http.HttpResponse("No request specified")
