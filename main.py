import time
import pyautogui
from datetime import datetime

# Set interval (dalam detik)
interval = 0.01

# Set durasi (dalam menit)
durasi = 1

# Hitung total iterasi
total_iterasi = int(durasi * 60 / interval)

# Dapatkan waktu mulai
start_time = datetime.now()



# Tunggu 3 detik
a = 3
time.sleep(3)
for i in range(a):
    print(f'Program akan dijalankan dalam hitungan : {i+1}')
# Jalankan loop untuk menekan enter
for i in range(total_iterasi):
    # Hitung waktu saat ini
    current_time = datetime.now()

    # Hitung waktu yang telah berlalu
    elapsed_time = (current_time - start_time).total_seconds()

    # Jika waktu yang telah berlalu lebih dari durasi, hentikan loop
    if elapsed_time > durasi * 60:
        break

    # Tunggu interval
    time.sleep(interval)

    # Tekan enter
    pyautogui.press('enter')

# Tampilkan pesan selesai
print("Program selesai!")
