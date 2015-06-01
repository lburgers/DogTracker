import prowlpy
import shapely #need GEOS and distribute_setup
from shapely.geometry import Polygon
from shapely.geometry import Point
#substitue your own values for the variables below
yard = Polygon(((40.695229, -73.993011), (40.695568, -73.992880), (40.695330, -73.991960), (40.694979, -73.992129))) #boundaries of your property
String server = "YOUR SERVER URL"
String prowlCode = "YOUR PROWL NUMBER"
p = prowlpy.Prowl(prowlCode)
prevState = True

while (1) :
			#open and read location from latLong.txt
           f = open('latLong.txt', 'r')
           latLong = f.read()
           latLong = latLong.split(',')
	   lat =  float(latLong[0])
	   longi = float(latLong[1])
           #check if the coordinates are within the boundary
           dog = Point(lat,longi) 
           #if the dog has escaped send a notification to your iPhone
           if(dog.within(yard) != prevState ) :
                prevState = dog.within(yard)
                if (prevState == False) :
                    print("Dog Out!!")
                    #send notification with redirection to server
                    p.add('Dog Tracker','Dog On The Run',"Get Otis!", 1, None, server)

