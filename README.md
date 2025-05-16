# Laravel mail tester
Receive emails from other applications and view and comment on them in a web interface.

## Features
- Receive emails from other applications
- Comment on emails for collaboration
- View emails in HTML and text format
- Use spamassassin to check for spam
- View attachments
- View email headers
- Access to the raw email
- Pretty dashboard (If I may say so myself)

## Screenshots
### Dashboard
![Dashboard](.github/assets/dashboard.png)

### Account overview
![Account overview](.github/assets/email-overview.png)

### Html view
![Html view](.github/assets/email-html.png)

### Text view & Attachments
![Text view](.github/assets/email-text.png)

### Comments
![Comments](.github/assets/email-chat.png)

### Spam
![Spam](.github/assets/email-spam.png)



## Installation
1. Make sure you have php-mailparse installed. Read more on that [here](https://github.com/php-mime-mail-parser/php-mime-mail-parser)
2. Install the project using composer:
```bash
git clone git@github.com:NietThijmen/laravel-mailtester.git
cd laravel-mailtester

composer install
```
3. Copy the `.env.example` file to `.env` and fill in the required values.
```bash
cp .env.example .env
```
4. Generate the application key:
```bash
php artisan key:generate
```
5. Run the migrations:
```bash
php artisan migrate
```



## Running the service:
Use the following command to run the service:
```bash
php artisan mail:server --port=2025
```

I'd recommend using a process manager like [supervisor](http://supervisord.org/) to run the service in the background.

## License
The license can be found here: [LICENSE](./LICENSE.md)

## Contributing
If you want to contribute, please do so. I am open to any suggestions and pull requests.

## Support
There's not really support needed for a small project like this, but if you have any questions or suggestions, please feel free to open an issue or a pull request.

## Support me
If you like this project and want to support me, please consider buying me a coffee. You can do so by clicking the button below:

<a href="https://www.buymeacoffee.com/nietthijmen"><img src="https://img.buymeacoffee.com/button-api/?text=Support me&emoji=❤️&slug=nietthijmen&button_colour=FFDD00&font_colour=000000&font_family=Inter&outline_colour=000000&coffee_colour=000000" /></a>

