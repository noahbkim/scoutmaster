import json

from django import http
from django.shortcuts import render
from django.template import loader

# Create your views here.
def index(request):
    context = {}
    return render(request, "scout/index.html", context)
