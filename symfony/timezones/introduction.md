# Symfony Timezones

### Prejudice 
My inital thought on this was to store all the different timezones in the database. for that I was thinking to change the `date_default_timezone_set("Europe/London")` for each user. This apporach seems to be inccorrect. 

A better approach is to choose one timezone, for example UTC (Coordinated Universal Time) and then display the difference on the frontend. 
Twig is prepared for this with a handy funcation `{{ "now"|date("d.m.Y", "Europe/Paris") }}`. This will output the converted `Datetime` for the current time in Paris. 

### Solution
on the frontend get the current timezone with jquery and then enter in the timezone in the twig function `{{ "now"|date("d.m.Y", "Europe/Prague") }}`
if you want to use it will javaScript a solution: `let date = new Date("{{ finish|date("Y-m-d H:i:s", app.user.timezone) }}").getTime();` this is a bit hacky, but does the trick. Obviously `app.user.timezone` is relating to  a datebase column where the users timezone is stored. 

It seems Symfony do not natively offer a way of get the users timezone. (which is mental) However, this can be achived with javaScript for example:

`let timezone = Intl.DateTimeFormat().resolvedOptions().timeZone;` 

console.log the `timezone` var and it will return the string on the users current timezone for example `"Europe/Paris"`. you can then pass this to the backend. 

