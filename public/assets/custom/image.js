
imgInp.onchange = evt => {
      const [file] = imgInp.files
      if (file) {
        myimage.src = URL.createObjectURL(file)
      }
    }
