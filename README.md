# WordPress Theme Installation Guide

This document provides step-by-step instructions for installing and setting up the WordPress theme, including configuring the QR Menu plugin.

## Prerequisites

- A working installation of WordPress
- Access to your WordPress admin dashboard

## Installation Steps

1. **Install WordPress**:

   - Ensure you have WordPress installed on your server or local environment.

2. **Download the Theme**:

   - Download the theme files from the repository or source.

3. **Upload the Theme**:

   - Go to your WordPress admin dashboard.
   - Navigate to **Appearance -> Themes**.
   - Click on **Add New** and then select **Upload Theme**.
   - Choose the downloaded theme file and click **Install Now**.
   - Once installed, click **Activate** to activate the theme.

4. **Create a Blank Page**:

   - Navigate to **Pages -> Add New**.
   - Create a blank page and give it a title (e.g., "Home").
   - Click **Publish** to save the page.

5. **Set the Static Page**:

   - Go to **Settings -> Reading**.
   - In the **Your homepage displays** section, select **A static page**.
   - Choose the blank page you just created from the dropdown menu for the **Homepage** option.
   - Click **Save Changes**.

6. **Configure QR Menu Categories**:

   - Navigate to **QR Menu -> QR Menu Categories**.
   - Click on **Add New Category** to create a new category (e.g., "Beverages").
   - Once created, go to the category edit screen and find the **Order** field at the bottom.
   - Change the order field to a minimum of 1. The category with the lowest number will appear at the top of the list.
   - Click **Update** to save the changes.

7. **Add Products to QR Menu**:
   - Navigate to **QR Menu -> Add New**.
   - Fill in the product name, content, and select a featured image.
   - At the bottom, in the **Custom Fields** section, enter the price of the product in the **price** field.
   - Click **Publish** to save the product.

## Adding a QR Menu Navigation

To add a menu with links to the QR Menu categories on the page, follow these steps:

1. Go to `Appearance -> Menus` in WordPress and create a new menu.
2. Select "Custom Links" to add a new menu item.
3. In the **URL** field, add the SEO-friendly category name prefixed with `#`. For example, if the category is "Hot Meals," the URL should be `#hot-meals`.
4. Add the menu items and save.

## Conclusion

You have successfully installed the theme and configured the QR Menu plugin. Your WordPress site should now be set up with the desired functionality.

For any issues or questions, please refer to the theme documentation or the support forums.
