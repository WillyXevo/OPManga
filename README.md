# OPManga
This is an API for read manga.

## Getting Started
this is an open API so you don't need a key to access, simply clone this repositoory to your server and run it.
you can use this API for mobile developmet to make a online reading manga application.

## features : 
- List of all chapter
- List of all image of chapter
- example for web application run in php
```
your_server_address/index.php
```

## usage : 
### List of all chapter : 
```
your_server_address/api.php
```
result : 
```
[
	{
		"id":"a6...",
		"link":"link_to_acces_the_chapter",
		"judul":"Manga Chapter 2 : Chapter Tittle",
		"date":"Feb, 24 2019",
		"date_act":"2019-02-24"
	},
	{
		"id":"a2...",
		"link":"link_to_acces_the_chapter",
		"judul":"Manga Chapter 1 : Chapter Tittle",
		"date":"Feb, 12 2019",
		"date_act":"2019-02-12"
	}
]
```
### List of page : send a post request to 
```
your_server_address/api.php
with parameters :
- judul = "the_tittle_of_chapter" // you can get from result above name "judul"
- link = "link_to_acces_the_chapter" // you can get from result above name "link"
```
you will get result :
```
{
	"judul":"Manga Chapter 2 : Chapter Tittle",
	"img":[
		"https://i0.wp.com/chapter_2/00.jpg",
		"https://i0.wp.com/chapter_2/01.jpg",
		"https://i0.wp.com/chapter_2/02.jpg",
		"https://i0.wp.com/chapter_2/03.jpg",
		"https://i0.wp.com/chapter_2/04.jpg",
		"https://i0.wp.com/chapter_2/05.jpg",
		"https://i0.wp.com/chapter_2/06.jpg"
		]
}
```

## Requirement
* [PHP 5.5](http://php.net/downloads.php) - or later
* [php culr](http://php.net/manual/en/book.curl.php) - a library for scrapping 
* [simplehtmldom](http://simplehtmldom.sourceforge.net/) - A HTML DOM parser let you manipulate HTML in a very easy way!
