---
title: "/faces/:store_id"
excerpt: ""
---
This tells front-end who are currently in the store including both the new faces and returning customers' faces. The response contains two set of information.
  * **Set 1:** Today's visit count, num of females, num of males, and total sales amount for this store_id.
  * **Set 2: **Currently detected faces on the entrance camera, response includes the face id, the camera id which captured the face and face image_path to display for each one, if algorithm thinks it's a returning customer, it will also include "possible_returning_persons" attribute which include up to 3 possible persons object, each of the person object tells you the person_id, the confident rate of that face, and the history face image path of that person. If no "possible_returning_persons" attached, that means it's a new customer.