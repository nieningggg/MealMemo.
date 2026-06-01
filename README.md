# 🍛 MealMemo - The Art of Malaysian Cuisine

## 📌 Project Title & Description

**MealMemo** is a web-based recipe management system that showcases the rich culinary heritage of Malaysia. Users can browse authentic Malaysian recipes, save them to a personal cooklist, track cooking progress, and evaluate calorie intake. The platform features five major Malaysian food cultures: Malay, Chinese, Indian, Baba Nyonya, and Indigenous Bornean cuisine.

---

## ✨ Features Included

| Feature | Description |
|---------|-------------|
| 🔐 Authentication | Login & Register system with localStorage simulation |
| 🌓 Dark/Light Theme | Toggle between dark and light mode for better user experience |
| 📊 Dashboard | Visitor analytics chart, stats cards, culture cards with 3D flip effect |
| 🔥 Trending Menu | Nasi Lemak displayed as trending menu on dashboard |
| 📊 Recipe Meter | Progress bars showing total menus by culture |
| 📚 Recipe Catalog | 20+ Malaysian recipes with filter by culture & search by name/ID |
| 📝 Cooklist (Meal Planner) | Add recipes, adjust quantity, mark as cooked, view cooking history |
| 🔥 Calorie Evaluation | Bar chart showing energy comparison, status threshold indicator |
| 👤 Change Password | Users can update their account password |
| 📞 Support | Working contact form with validation |
| 🔔 Notifications | Welcome back notification after login |
| ⬆️ Back to Top Button | Floating button that appears when scrolling down, brings user to top of page |
| 📱 Responsive Design | Works on desktop, tablet, and mobile devices |
| 🎨 Glassmorphism UI | Modern blurred background effects on cards and sidebar |
| 🔗 Social Media Links | Instagram and Facebook links in footer |

---

## 🔑 Instructions to Test Login

### Test Credentials

| Role | Username | Password |
|------|----------|----------|
| **Admin** | `admin` | `password123` |
| **Regular User** | Register a new account | Any password |

### Step-by-Step Testing Instructions

#### 1. Access the Application
- Open the live website link (GitHub Pages)
- Landing page will appear with "LOG IN NOW" and "CREATE ACCOUNT" buttons

#### 2. Login as Admin
- Click **"LOG IN NOW →"** button
- Enter username: `admin`
- Enter password: `password123`
- Click **"LOG IN SECURELY →"**
- You will be redirected to the Dashboard

#### 3. Create a New Account (Regular User)
- On login page, click **"Sign Up here"**
- Enter your desired username
- Enter your password
- Click **"REGISTER NEW ACCOUNT"**
- After success message, you will be redirected to login page
- Login with your new credentials

#### 4. Explore Dashboard Features
- View analytics chart (click 30 days / 7 days / 24 hours tabs)
- Hover over stat cards to see information
- View **Trending Menu** card (Nasi Lemak with animated fire icons)
- View **Recipe Meter** showing total menus by culture with progress bars
- Click on culture cards to read cultural stories (3D flip effect)
- Toggle dark/light mode using moon/sun icon in topbar

#### 5. Test Recipe Catalog
- Navigate to **Catalog** page from sidebar menu
- Filter recipes by culture (Malay, Chinese, Indian, Baba Nyonya, Borneo)
- Search recipes by name or ID
- Click **"Add to Cooklist"** on any recipe
- Notification will appear confirming addition

#### 6. Test Cooklist (Meal Planner)
- Navigate to **Cooklist** page
- View all added recipes
- Adjust quantity using **+ / -** buttons
- Check **"Mark Cooked"** checkbox to mark recipe as completed
- View completed recipes in **"Completed Cooking History"** table
- View pie chart showing pending vs cooked ratio

#### 7. Test Calorie Evaluation
- Navigate to **Calorie Evaluation** page
- View total calculated energy, status threshold, and indexed items
- View bar chart comparing energy content of each recipe

#### 8. Test Change Password
- Click on user avatar in top-right corner
- Select **"Change Password"** from dropdown
- Enter current password
- Enter new password
- Confirm new password
- Click **"Save Password"**

#### 9. Test Support (Contact Form)
- Navigate to **Contact Us** page from sidebar
- Fill in name, email, subject, and message
- Click **"Send Message"**
- Success toast notification will appear

#### 10. Test Back to Top Button
- Scroll down any page
- A floating orange button with up arrow will appear in bottom-right corner
- Click the button to smoothly scroll back to top of page

#### 11. Test Footer Links
- Scroll to bottom of any page
- Click Instagram icon to open UiTM Instagram page (opens in new tab)
- Click Facebook icon to open UiTM Facebook page (opens in new tab)

#### 12. Logout
- Click on user avatar in top-right corner
- Select **"Log Out"** from dropdown
- You will be redirected to login page

---

## 🛠️ Frameworks & Libraries Used

| Technology | Version | Purpose |
|------------|---------|---------|
| **Bootstrap 5** | 5.3.3 | CSS framework for responsive layout and components |
| **Tailwind CSS** | Latest (CDN) | Used for login and register pages styling |
| **Chart.js** | 4.4.0 | Data visualization (bar charts & pie chart) |
| **Bootstrap Icons** | 1.11.0 | Icon library for all interface icons |
| **Google Fonts** | Inter & Plus Jakarta Sans | Custom typography |
| **JavaScript (Vanilla)** | ES6 | Interactivity and DOM manipulation |
| **HTML5** | - | Structure and semantics |
| **CSS3** | - | Custom styling with CSS variables for theming |

### Additional Technologies
- **localStorage API** - Client-side data persistence
- **CSS Flexbox & Grid** - Layout management
- **CSS Animations** - Shake effect, beep dot, slide up, flip cards, flicker animation
- **Glassmorphism** - Backdrop blur effects on UI components

---

## 📁 Project Files Structure

---

## 💾 localStorage Data Structure

| Key | Type | Purpose |
|-----|------|---------|
| `currentUser` | String | Stores current logged-in username |
| `mealmemo_users` | Array | Stores registered users (username, password) |
| `mealmemo_trolley` | Array | Stores recipes added to cooklist (id, name, calories, quantity, cooked status) |
| `mealmemo_loginTime` | ISO String | Timestamp of last login |
| `mmTheme` | String | Theme preference ('light' or 'dark') |

---

## 📱 Responsive Breakpoints

| Device | Screen Width | Sidebar Behavior |
|--------|--------------|------------------|
| Desktop | > 992px | Full sidebar visible |
| Tablet | 768px - 991px | Collapsible sidebar with burger menu |
| Mobile | < 768px | Collapsible sidebar with burger menu |

---

## 🎨 Color Scheme

| Color | Hex Code | Usage |
|-------|----------|-------|
| Accent Orange | `#d97706` | Primary buttons, active states, icons |
| Slate Navy | `#0b1528` | Sidebar, logout button, dark elements |
| Light Background | `#f0f2f5` | Page background (light mode) |
| Dark Background | `#0d1117` | Page background (dark mode) |

---

## 🧪 Browser Support

| Browser | Version | Status |
|---------|---------|--------|
| Google Chrome | Latest | ✅ Fully supported (recommended) |
| Mozilla Firefox | Latest | ✅ Supported |
| Microsoft Edge | Latest | ✅ Supported |
| Safari | Latest | ✅ Supported |

---

## 👨‍💻 Author

**IMS566 Company**  
Faculty of Information Management  
Universiti Teknologi MARA (UiTM)

---

## 🔗 Live Demo

[Insert your GitHub Pages live link here]


---

## 📦 GitHub Repository

https://github.com/nieningggg/MealMemo.

---

## © 2026 IMS566 Company. All rights reserved.
