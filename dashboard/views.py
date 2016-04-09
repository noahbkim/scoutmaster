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
    return render(request, "dashboard/index.html", {})
