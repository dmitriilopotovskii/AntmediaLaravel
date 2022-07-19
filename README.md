## installation

- clone repository

```
git clone https://github.com/dmitriilopotovskii/AntmediaLaravel.git
```

- install composer dependencies <code>composer install</code>
- Copy <code>.env.example</code> file to <code>.env</code> on the root folder.
- Run  <code>php artisan key:generate</code>
- Run <code>./vendor/bin/sail up</code>
- Run <code>./vendor/bin/sail npm install</code>
- Run <code>./vendor/bin/sail npm run dev</code>
- Go to <code>https://localhost:5443/#/pages/login<code>
- username:<code>subcdev</code> password:<code>password</code>
- Then https://localhost:5443/#/applications/LiveApp Settings disable  "Enable IP Filter for RESTful API"
- Run <code>./vendor/bin/sail artisan migrate --seed</code>
- Go to http://localhost/




