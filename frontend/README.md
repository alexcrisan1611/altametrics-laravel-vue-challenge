# Altametrics Job Test Frontend

Welcome to my frontend documentation!

## Getting Started

### Necessary Software

In order to get started, you need a collection of technologies installed on your computer:

1. Node
2. PNPM (Node package manager)

### First-time Actions

First, start your backend environment.

To get started, make sure you've run the following commands inside the `frontend` folder:
- `pnpm i` installs the project's Node packages
- `pnpm dev` starts the dev server; you will be able to see the app's URL
- go to the local development location (by default, it's http://localhost:5173/)

### Authentication

This frontend's auth system has been tuned to match a modern user's expectations from a web app.

For your convenience, I have automatically filled the form with the default user's credentials:
- Email: me@altametrics.com
- Password: password

After you've successfully logged in, the app will redirect you to the invoices page. There's also the empty home page, as per instructed in the PDF.

### Invoices Features

This invoices app showcases a number of features that facilitate invoice data inspection.

#### The Invoices Table

The invoices table lets you see all your invoices in a user-friendly manner. It synergizes with the database in that it has all the invoices data columns available for you to see. It also has a nice pagination element that makes it possible to navigate the invoices.

#### The Invoice Dialog

The invoice dialog element is a simple and focused element that makes it easy to see what an individual invoice presents. Each invoice has a button at the end of its row in the invoices table, which can be pressed to access this element.
