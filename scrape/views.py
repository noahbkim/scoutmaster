from django.shortcuts import render

# Create your views here.
def scrape(request):
    if REQUEST in request.GET:
        return http.HttpResponse(scraper.raw(request.GET[REQUEST]))
    else:
        return http.HttpResponse("No request specified")
