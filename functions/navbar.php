<nav id="nav" style="background-color: #f4f4f4; padding: 1rem; display: flex; flex-wrap: wrap; justify-content: space-between; align-items: center;">
    <div class="nav-links" style="display: flex; flex-wrap: wrap; gap: 1rem;">
      <a href="index_nomenclature.php" style="text-decoration: none; color: #222; padding: 0.5rem 1rem; border-radius: 5px;">Nomenclatures</a>
      <a href="index_components.php" style="text-decoration: none; color: #222; padding: 0.5rem 1rem; border-radius: 5px;">Composants</a>
      <a href="index_produits.php" style="text-decoration: none; color: #222; padding: 0.5rem 1rem; border-radius: 5px;">Produits</a>
      <a href="update_produits.php" style="text-decoration: none; color: #222; padding: 0.5rem 1rem; border-radius: 5px;">Modifier Produits</a>
      <a href="update_components.php" style="text-decoration: none; color: #222; padding: 0.5rem 1rem; border-radius: 5px;">Modifier Composants</a>
    </div>
    <button onclick="toggleDarkMode()" style="background: none; border: 1px solid #222; color: #222; padding: 0.5rem 1rem; border-radius: 5px; cursor: pointer;">🌗 Mode</button>
  </nav>

  <script>
    function toggleDarkMode() {
      const body = document.body;
      const nav = document.getElementById('nav');
      const links = document.querySelectorAll('a');
      const button = document.querySelector('button');

      body.classList.toggle('dark');
      
      if (body.classList.contains('dark')) {
        body.style.backgroundColor = '#121212';
        body.style.color = '#ffffff';
        nav.style.backgroundColor = '#1e1e1e';
        links.forEach(link => link.style.color = '#ffffff');
        button.style.border = '1px solid #ffffff';
        button.style.color = '#ffffff';
      } else {
        body.style.backgroundColor = '#ffffff';
        body.style.color = '#222222';
        nav.style.backgroundColor = '#f4f4f4';
        links.forEach(link => link.style.color = '#222222');
        button.style.border = '1px solid #222222';
        button.style.color = '#222222';
      }

      localStorage.setItem('darkMode', body.classList.contains('dark'));
    }

    window.onload = () => {
      if (localStorage.getItem('darkMode') === 'true') {
        toggleDarkMode();
      }
    }
  </script>