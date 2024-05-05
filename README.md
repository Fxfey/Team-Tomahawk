# Team Tomahawk
---
Team Tomahawk is an airsoft group owned by a friend of mine, they play all over the country in a big group. I decided to create a project that means something, therefore this repository was born!

## Contents

This Repository contains two main things:

1. [WordPress Theme](https://github.com/Fxfey/Team-Tomahawk/tree/main)
2. [Endpoints Folder](https://github.com/Fxfey/Team-Tomahawk/tree/main/endpoints)

## WordPress Theme

The them creates a fully responsive site that holds the specifics of what my friend Dan wanted the site to contain:
- Homepage
A page dedicated to a brief explainer of the group including an image, below that is two sections. A quotes area which randomly shows three real quotes from members which includes a real image of them. Next to this we have the latest blog post.
<br>
- Story
The story page contains a timeline of T2's (Team Tomahawk) events which is pulled from a database table and dynamically displayed.
<br>
- Blog
A place to contain larger scale written descriptions (with photos) of events attended or even just containing anything airsoft!
<br>
- Recommendations
This page showcases the site the group regularly plays at and recommends to players, this page is hardcoded as it it very unlikely to change.
<br>
- Joining
The Join page displays a form for people to submit some information about themselves, after this will send an email directly to Dan for him to review / speak to them about.

## Endpoints Folder

The endpoints folder contains a few API endpoints i made which live on the same server as the site, although it is not very safe to make the exact code in the endpoints public, for project purposes i have decided to do so.

- Auth Endpoint

    No Parameters for the Auth endpoint other then a Bearer token & a user header. These are expected to be used with every API call.
    <br>

- Story Endpoints

    - Create *[Parameters]*

        This endpoint will create a row for data used for the timeline

    | Name          | Required  | Type   | Description |
    | :---          | :------:  | :----: |        --- |
    | title         | required  | text   | This will insert the title of the timeline event |
    | text          | required  | text   | This will insert the text describing the timeline event |
    | date_of_event | required  | text   | This will insert the date string of when the event took place |

    - Delete *[Parameters]*

        This endpoint will delete a row fo data used for the timeline


    | Name          | Required  | Type   | Description |
    | :---          | :------:  | :----: |        --- |
    | id         | required  | text   | This will be used to get the id of the row you wish to delete

