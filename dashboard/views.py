from django import http
from django.shortcuts import render
from django.template import loader

import requests

# Create your views here.
def index(request):
    context = {}
    return render(request, "dashboard/index.html", context)

