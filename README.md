# Job Seeker 
**This repository is only a sandbox aka playground with Laravel 11 and Inertia/Vue3.**
So new changes/features/bugs will definitely appear in the future :D

_Feel free to copy and modify anything what you want here._

The working demo might be found here: https://job-seeker.markovrecords.com/

### Stack of technologies used here:
- [Laravel 11](https://laravel.com/docs/11.x) as a core of the website;
- [Vue.js3](https://vuejs.org/) as a frontend;
- [Inertia](https://inertiajs.com/) as a bridge between backend and frontend technologies;
- [TailwindCSS](https://tailwindcss.com/docs) as a CSS framework;
- [Redis](https://redis.io/) as a cache and queue provider;
- [Reverb](https://reverb.laravel.com/) as a socket functionality provider;
- [Forge](https://forge.laravel.com/) as deployment tool;
- [TinyMCE](https://www.tiny.cloud/) for WYSIWYG fields;
- [DDev](https://ddev.com/) as a local docker environment; 

### Local deployment
1. `git clone git@github.com:stasmarkov/job-seeker-laravel.git`
2. `ddev start`
3. Update `.env` file with relevant:
   1. TinyMCE key;
   2. DB connection;
   3. Reverb connection;
4. Run following tasks in different terminal tabs:
   1. `ddev artisan queue:work --queue=mail,default`
   2. `ddev artisan reverb:start --host="0.0.0.0" --port=8080  --debug`
   3. `npm i && npm run dev`
5. Run the migration command: `ddev artisan migrate:fresh --seed` and you are ready to check or probably work on this site!



Todo:
1. php artisan love:register-reacters --model="App\Models\User"
2. artisan love:register-reactants --model="App\Models\Job"
