<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Tambah Data Supermarket</title>
    <!-- Bootstrap CSS -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>
    <div class="container mt-5">
        <h1 class="mb-4">Form Tambah Data Supermarket</h1>
        <form id="dataForm" action="postinsertdata.php" method="POST">
            <input type="hidden" id="api_key" name="api_key" value="YOUR_API_KEY">

            <div class="form-group">
                <label for="Invoice_ID">ID Faktur:</label>
                <input type="text" class="form-control" id="Invoice_ID" name="Invoice_ID" required>
            </div>

            <div class="form-group">
                <label for="Branch">Cabang:</label>
                <select class="form-control" id="Branch" name="Branch" required>
                    <option value="A">A</option>
                    <option value="B">B</option>
                    <option value="C">C</option>
                </select>
            </div>

            <div class="form-group">
                <label for="City">Kota:</label>
                <select class="form-control" id="City" name="City" required>
                    <option value="Mandalay">Mandalay</option>
                    <option value="Naypyitaw">Naypyitaw</option>
                    <option value="Yangon">Yangon</option>
                </select>
            </div>

            <div class="form-group">
                <label for="Customer_type">Tipe Pelanggan:</label>
                <select class="form-control" id="Customer_type" name="Customer_type" required>
                    <option value="Member">Member</option>
                    <option value="Normal">Normal</option>
                </select>
            </div>

            <div class="form-group">
                <label for="Gender">Jenis Kelamin:</label>
                <select class="form-control" id="Gender" name="Gender" required>
                    <option value="Laki-laki">Laki-laki</option>
                    <option value="Perempuan">Perempuan</option>
                </select>
            </div>

            <div class="form-group">
                <label for="Product_line">Baris Produk:</label>
                <input type="text" class="form-control" id="Product_line" name="Product_line" required>
            </div>

            <div class="form-group">
                <label for="Unit_price">Harga Satuan:</label>
                <input type="number" class="form-control" id="Unit_price" name="Unit_price" step="0.01" required>
            </div>

            <div class="form-group">
                <label for="Quantity">Kuantitas:</label>
                <input type="number" class="form-control" id="Quantity" name="Quantity" required>
            </div>

            <div class="form-group">
                <label for="Tax_5_percen">Pajak 5%:</label>
                <input type="number" class="form-control" id="Tax_5_percen" name="Tax_5_percen" step="0.01" required>
            </div>

            <div class="form-group">
                <label for="Total">Total:</label>
                <input type="number" class="form-control" id="Total" name="Total" step="0.01" required>
            </div>

            <div class="form-group">
                <label for="Date">Tanggal:</label>
                <input type="date" class="form-control" id="Date" name="Date" required>
            </div>

            <div class="form-group">
                <label for="Time">Waktu:</label>
                <input type="time" class="form-control" id="Time" name="Time" required>
            </div>

            <div class="form-group">
                <label for="Payment">Pembayaran:</label>
                <select class="form-control" id="Payment" name="Payment" required>
                    <option value="Wallet">Wallet</option>
                    <option value="Cash">Cash</option>
                </select>
            </div>

            <div class="form-group">
                <label for="Cogs">HPP (Harga Pokok Penjualan):</label>
                <input type="number" class="form-control" id="Cogs" name="Cogs" step="0.01" required>
            </div>

            <div class="form-group">
                <label for="Gross_margin_percentage">Persentase Margin Kotor:</label>
                <input type="number" class="form-control" id="Gross_margin_percentage" name="Gross_margin_percentage" step="0.01" required>
            </div>

            <div class="form-group">
                <label for="Gross_income">Pendapatan Kotor:</label>
                <input type="number" class="form-control" id="Gross_income" name="Gross_income" step="0.01" required>
            </div>

            <div class="form-group">
                <label for="Rating">Rating:</label>
                <input type="number" class="form-control" id="Rating" name="Rating" step="0.1" required>
            </div>

            <button type="submit" class="btn btn-primary">Tambah Data</button>
        </form>

        <div id="response" class="mt-3"></div>
    </div>

    <!-- Bootstrap JS and dependencies -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

</body>

</html>