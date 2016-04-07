from django import http
from django.shortcuts import render
from django.template import loader

import requests

# Create your views here.
def index(request):
    template = loader.get_template("dashboard/index.html")
    context = {}
    return HttpResponse(template.render(context, request))

