from django import http
from django.shortcuts import render
from constants import *

import scraper

# Create your views here.
def scrape(request, path=None):
    path = path or request.GET.get(REQUEST)
    if path:
        return http.HttpResponse(scraper.raw(path))
    else:
        return http.HttpResponse("No request specified")
