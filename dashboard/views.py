from django import http
from django.shortcuts import render

import requests

# Create your views here.
def index(request):
    return http.HttpResponse("Dashboard!")
