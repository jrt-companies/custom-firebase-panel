# Custom Firebase Panel
### Write JSON
#### Make yor own one
##### SEO
`title` **String** _required_ Sets the title that will be displayed in SEO or messengers when sending your panel url\
`desc` **String** _required_ Sets the description that will be displayed in SEO or messengers when sending your panel url\
`crawl` **Boolean** _required_ Decides if searchengines should crawl the website, it true site could be displayed on a searchengine\
##### Style
Colors
`primary` **String** _required_ Sets the primary color of your panel. HEX, RGB, HSL formats are supported.\
`primaryLight` **String** _required_ Sets the primaryLight color of your panel. HEX, RGB, HSL formats are supported.\
##### Panel
`name` **String** _required_ Is the panel name, that will be displayed on the panel.\
`support` **String** A link that redirects user to a support page. Mailto or Tel are also accepted. If empty, there is no support button.\
`supportName` **String** Text of the support button, the support var above must be set.\
`startTabArray` **int** _required_ Decides on wich tab the panel should open first. Works based on the tabs var below and starts from 0 up to object number -1.\
`startTabArray`  **Array** _required_ Includes all panel tabs.\
- `title` **String** _required_ Is the tab name, that will be displayed, that will be displayed on the panel nav bar and the tab titels.\
- `db` **String** _required_ The database the documents (objects) are loaded from.\
- `faIcon` **String** _required_ The name of a [fontawesome icon](https://fontawesome.com/v4.7/icons/), that will be displayed with the panel name.\
##### Table
`columns`  **Array** _required_ Defines the columns of the table.\
- `title` **String** _required_ Is the colum name, that will be displayed at the top.\
- `docData` **String** _required_ Defines which data from the documents (objects) should be displayed\
##### Panel
`apiKey` **String** _required_ The API Key of your firebase project.\
`authDomain` **String** _required_ The auth domain of your firebase project.\
`projectId` **String** _required_ The project ID of your firebase project.\
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
