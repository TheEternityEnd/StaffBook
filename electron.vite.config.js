import { resolve } from 'path'
import { defineConfig, externalizeDepsPlugin } from 'electron-vite'

export default defineConfig({
  main: {
    plugins: [externalizeDepsPlugin()],
    build: {
      rollupOptions: {
        input: {
          index: resolve(__dirname, 'src/main/index.js')
        }
      }
    }
  },
  preload: {
    build: {
      rollupOptions: {
        input: {
          index: resolve(__dirname, 'src/preload/index.js')
        }
      }
    }
  },
  renderer: {
    // Le dice a Vite que la raíz de tu frontend está en src/renderer
    root: 'src/renderer',
    build: {
      rollupOptions: {
        // Se define cada página HTML como un punto de entrada
        input: {
          index: resolve(__dirname, 'src/renderer/index.html'),
          dashboard: resolve(__dirname, 'src/renderer/dashboard.html'),
          form: resolve(__dirname, 'src/renderer/form.html'),
          permisos: resolve(__dirname, 'src/renderer/permisos.html'),
          depa: resolve(__dirname, 'src/renderer/depa.html'),
          admin: resolve(__dirname, 'src/renderer/admin.html'),
          reports: resolve(__dirname, 'src/renderer/reports.html'),
          settings: resolve(__dirname, 'src/renderer/settings.html'),
          help: resolve(__dirname, 'src/renderer/help.html')
        }
      }
    }
  }
})