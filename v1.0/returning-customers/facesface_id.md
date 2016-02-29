---
title: "/faces/:face_id"
excerpt: "Update a face with a person_id. (This is to flag a face to be a person.)"
---
When store sales verify a new guest(face) is a returning customer(person), send this request to update guest(face) with the right person_id. 
[block:code]
{
  "codes": [
    {
      "code": "{\n\t\"person_id\" : \"personb4b1b51ac91e391e5afe130eb78\"\n}",
      "language": "json"
    }
  ]
}
[/block]
If customer declines the guest(face) is a returning customer(person), send the same request but with an empty value of person_id like following.
[block:code]
{
  "codes": [
    {
      "code": "{\n\t\"person_id\" : \"\"\n}",
      "language": "json"
    }
  ]
}
[/block]