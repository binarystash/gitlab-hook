# Sync Gitlab with your LAMP website

A [webhook](https://gitlab.com/gitlab-org/gitlab-ce/blob/master/doc/web_hooks/web_hooks.md) is a facility that allows a URL to be triggered for specific Gitlab actions. For instance, code can be deployed to a production server whenever pushing code or tagging a branch is done. 

For accuracy's sake, this guide was prepared for a new installation of Ubuntu 14.04 on Digital Ocean. A Gitlab.com project was used. 

### Prerequisites
* An existing Gitlab.com project
* A LAMP setup on Digital Ocean Ubuntu 14.04

### Set up the repository

1. SSH to the server as root. If you log in as another user, you may eventually encounter permission errors.

If you're using Linux: type `ssh <ip_address_of_your_server>`
If you're using Windows: use Putty

2. Find or generate your server's [SSH key](http://doc.gitlab.com/ce/ssh/README.html). This will be used to provide your server read-only access to the repository.

3. On the sidebar of your Gitlab.com project, go to **Settings->Deploy Keys**. Add the SSH key from step 1.

### Add hook to your project

1. Copy and paste the **gitlab-hook** folder to your project. It must be in the same folder with .git, otherwise the script would fail.

2. Commit the changes.
  ```
  git add .
  git commit -m 'Added hook script'
  ```

3. Push it to gitlab. Replace `<origin>` with the remote name and `<branch>` with the branch you must push it to (i.e. master).
  ```
  git push <origin> <branch>
  ```

### Set up production server

1. SSH to the server as root.

2. Install Git and PHP if they are not yet installed.
  ```
  apt-get install git php5 libapache2-mod-php5 php5-mcrypt
  ```

3. Go to your webroot. Make sure that this directory is empty, otherwise, Git will fail.
  ```
  cd /var/www/html
  ```

6. Clone your gitlab.com project to the server.
  ```
  git clone git@gitlab.com:<project_group>/<project_name> /var/www/html/
  ```

6. Make `gitlab-hook/json` writable by www-data. 
  ```
  chown -R www-data:www-data /var/www/html/gitlab-hook/json
  ```

### Set up webhook

1. On your project's sidebar on Gitlab.com, go to **Settings->Webhooks**.

2. Input the URL. If your site is http://www.mywebsite.com, then the URL should be:
  ```
  http://www.mywebsite.com/gitlab-hook/trigger.php?action=update
  ```

3. If the sync must only happen when a tag is created, uncheck all triggers and check **Tag push events**.

4. Uncheck **Enable SSL verification** if you don't know what it is for.

###  Set up cron

1. SSH to the server as root.

2. Type `crontab -e`

3. Add the following to sync your repo every minute.
  ```
  * * * * * /usr/bin/php /var/www/html/gitlab-hook/trigger.php pull
  ```

4. CONGRATULATIONS! Every time you push a tag, your repo and production server should sync.

