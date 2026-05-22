import os

search_dir = r"c:\laragon\www\siakaddev\siadev\resources\views"
query = "Tidak ada form berkas"

found = False
for root, dirs, files in os.walk(search_dir):
    for file in files:
        if file.endswith('.php'):
            filepath = os.path.join(root, file)
            try:
                with open(filepath, 'r', encoding='utf-8', errors='ignore') as f:
                    content = f.read()
                    if query in content:
                        print(f"Found in: {filepath}")
                        found = True
            except Exception as e:
                pass

if not found:
    print("Not found in views.")
