import os
import requests
from bs4 import BeautifulSoup
from urllib.parse import urljoin

# URL of the page to scrape
url = "https://demo.egenslab.com/html/bidout/preview/blog-details.html"

# Path to the base directory where images will be saved
base_save_folder = "public/assets/images"

# Create the base save folder if it doesn't exist
os.makedirs(base_save_folder, exist_ok=True)

# Send a GET request to the URL
response = requests.get(url)

# Parse the HTML content using BeautifulSoup
soup = BeautifulSoup(response.content, "html.parser")

# Find all img tags in the HTML
img_tags = soup.find_all("img")

# Download and save each image
for img_tag in img_tags:
    img_url = img_tag.get("src")
    if img_url:
        img_url = urljoin(url, img_url)
        img_name = img_url.split("/")[-1]
        img_folder_path = os.path.join(base_save_folder, img_url.split("/")[-2])  # Extract the subfolder name
        os.makedirs(img_folder_path, exist_ok=True)
        img_save_path = os.path.join(img_folder_path, img_name)
        
        # Download the image using requests
        img_response = requests.get(img_url)
        with open(img_save_path, "wb") as img_file:
            img_file.write(img_response.content)
        
        print(f"Downloaded: {img_name} to {img_folder_path}")

print("Image scraping and downloading completed.")
