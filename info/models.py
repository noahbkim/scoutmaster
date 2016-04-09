from django.db import models

# Create your models here.
class OprDprModel(models.Model):

    team = models.CharField(max_length=10)
    rank = models.IntegerField(max_length=3)
    opr = models.DecimalField(max_digits=10, decimal_places=3)
    dpr = models.DecimalField(max_digits=10, decimal_places=3)

