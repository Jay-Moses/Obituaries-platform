# Obituary Management Platform

## Overview
The Obituary Management Platform allows users to submit and view obituaries online. This platform includes features for submitting obituary details, viewing a list of obituaries with pagination, and integrating SEO and social media optimization.

## Table of Contents
- [Setup](#setup)
- [Development Process](#development-process)
- [SEO and Social Media Optimization](#seo-and-social-media-optimization)
- [Usage](#usage)
- [Troubleshooting](#troubleshooting)
- [Additional Resources](#additional-resources)
- [Contact Information](#contact-information)

## Setup

### System Requirements
- **Server**: Apache 2.4 or higher
- **PHP**: Version 8.0 or higher
- **Database**: MySQL or compatible database
- **OpenSSL**: Version 3.1.3 or higher
- **Browser**: Modern web browser (Chrome, Firefox, Edge)

### Installation Steps

1. **Create the Database Table**

   ```sql
   CREATE TABLE obituaries (
       id INT AUTO_INCREMENT PRIMARY KEY,
       name VARCHAR(255) NOT NULL,
       dob DATE NOT NULL,
       dod DATE NOT NULL,
       content TEXT NOT NULL,
       author VARCHAR(255) NOT NULL
   );
## Configure Apache Virtual Host

Update your `httpd.conf` or `apache2.conf` with the following configuration:

```apache
<VirtualHost *:80>
    DocumentRoot "C:/path/to/your/application"
    ServerName localhost
    <Directory "C:/path/to/your/application">
        AllowOverride All
        Require all granted
    </Directory>
</VirtualHost>
