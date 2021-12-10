# Custom Firebase Panel
### Write JSON
#### Standard JSON
```
{
    "seo": {
        "title": "Costum Panel Title",
        "desc": "Costum Panel Description",
        "crawl": false
    },
    "style": {
        "colors": {
            "primary": "#CA3216",
            "primaryLight": "#994444"
        }
    },
    "panel": {
        "name": "Costum Panel Name",
        "support": "mailto:support@example.com?subject=Support Mail From Panel&body=Describe your problem here...",
        "supportName": "Get Support",
        "startTabArray": 0,
        "tabs": [
            {
                "title": "Users",
                "db": "users",
                "faIcon": "fa-chalkboard"
            },
            {
                "title": "News",
                "db": "news",
                "faIcon": "fa-newspaper"
            }
        ],
        "table": {
            "columns": [
                {
                    "title": "Fist Name",
                    "docData": "first"
                },
                {
                    "title": "Last Name",
                    "docData": "last"
                },
                {
                    "title": "Born",
                    "docData": "born"
                }
            ]
        }
    },
    "firebase": {
        "apiKey": "",
        "authDomain": "",
        "projectId": ""
    }
}
```