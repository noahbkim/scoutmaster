import json

from django import http
from django.shortcuts import render
from django.template import loader

import scraper
import numpy
from . import models
from constants import *

# Create your views here.
def index(request):
    return render(request, "info/index.html", {})

def pr(request, event):
    out = {"a": 1}
    return http.HttpResponse(json.dumps(out))
