# APIkachu: Unleash Your Custom Pokémon Adventure! 🚀

Welcome to APIkachu, where the magic of custom Pokémon creation comes to life!
🌟

## 🎮 Project Overview

Embark on a thrilling journey with our APIkachu, a key component of the
groundbreaking Pokémon Customization Platform. Imagine a world where your seed phrases
shape the very essence of Pokémon existence. Our API seamlessly connects with OpenAI's
ChatGPT and Dal-e, transforming your imagination into unique, never-before-seen Pokémon.

## 🌈 Why APIkachu?

- **Unleash Creativity:** Type in your seed phrase, and watch as the API conjures Pokémon
  born from your words.
- **Interactive Adventures:** Explore a world where each Pokémon is a reflection of your
  unique story.
- **Community Collaboration:** Share your custom Pokémon creations and collaborate with
  fellow trainers.
- **Research:** Advance the understanding of Pokémon by hypothesizing plausible Pokémon.

## 🛠️ Requirements

Before you embark on your APIkachu adventure, make sure you have the following:

- **Web Server:** You'll need a web server such as Apache to host the APIkachu.
- **Database Server:** APIkachu relies on a MySQL database server, such as MariaDB,
  for storing Pokémon data.
- **OpenAI:** APIkachu relies on Openai as its large language model and image generator. 
To make this work you need an Openai account with credits.

## 🚀 Getting Started

Ready to dive in? Whether you're a seasoned Pokémon Master or just starting your journey,
this API welcomes trainers of all levels.

- **Retrieve the source:**
  `git clone git@git.nexed.com:raymonroos/apikachu-deep-dive.git apikachu && cd apikachu/apikachu`

- **Environment**: Run `cp .env && php artisan key:generate` to set up your
  environment variables. Then copy and paste the .env.example file into the new .env file you just created. 
  Note that you have to set the right database credentials for your
  system. At the Bit Academy, we have a convention for what database user to use, but you
  may choose your own and update `.env` accordingly.

- Create an empty database called `apikachu`. If you want a different name, update the
  value in `.env`

- **Libraries:** `php composer install`

- **Database contents:** To set up the tables, and retrieve some starting data:
  `php artisan migrate:fresh --seed`
  Data is retrieved from `https://pokeapi.co/api/v2/`, the first time seeding is a little
  slow, as we don't want to spam their api. The data is saved to disk for future
  reuse. 

- **Launch:** Start your database and http servers. For convenience, you can also use 
  `php artisan serve` instead of the latter.

- **Connect OpenAI with this project**: Follow this [link](https://platform.openai.com/signup) and create an Openai account then put some credits on it on this [page](https://platform.openai.com/account/billing/overview). Then create an Api key on this [page](https://platform.openai.com/api-keys) then copy and past the following at the end of your env file OPENAI_API_KEY="Your_genereated_key".

- **Enjoy:** You can now explore the API at your leisure! Open `localhost/api/pokemon` in your
  browser, postman, or `curl`. 


## 🌐 Project Links

- [Documentation](./../docs)
- [Project Board](https://apikachu.atlassian.net/jira/software/projects/SCRUM/boards/1)

## 🎉 Join the APIkachu Revolution!

Become a part of the APIkachu revolution and bring your custom Pokémon dreams to life.
It's time to unleash the power of imagination and redefine what it means to be a Pokémon
Trainer! 🌟
