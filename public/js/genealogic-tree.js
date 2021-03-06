class SheetLoader {
  constructor(onLoadAllCallBack = undefined) {
    this.sheetsToLoad = [];
    this.sheetsLoaded = 0;
    this.loadAllCallBack = onLoadAllCallBack;
    this.queue = [];
  }

  onLoadSheet() {
    this.sheetsLoaded++;
    if (this.sheetsLoaded >= this.queue.length) {
      if (this.loadAllCallBack) {
        this.loadAllCallBack();
      }
    }
  }

  queueSheet(filepath) {
    const newSheet = new Image();
    this.queue.push({ filepath: filepath, image: newSheet });
    newSheet.src = filepath;
    return newSheet;
  }

  loadSheetQueue(onLoadAllCallBack = undefined) {
    if (onLoadAllCallBack) {
      this.loadAllCallBack = onLoadAllCallBack;
    }

    this.queue.map((item) => {
      item.image.addEventListener("load", () => {
        this.onLoadSheet();
      });
    });
  }
}

// ======================================== Dependencias

class GenealogicTree {
  constructor(canvasID) {
    this.canvas = document.getElementById(canvasID);
    this.ctx = this.canvas.getContext("2d");

    this.resizeCanvas = () => {
      this.canvas.width = this.canvas.parentElement.offsetWidth;
      this.canvas.height = this.canvas.parentElement.offsetHeight;
      if (this.canvas.height < 300) this.canvas.height = 300;

      if (this.canvas.width == 0) {
        setTimeout(() => {
          this.resizeCanvas();
        }, 100);
      }
    };

    window.addEventListener("resize", () => {
      this.resizeCanvas();
    });
    this.resizeCanvas();
  }

  static engineStates = {
    LOADING: "loading",
    PLAYING: "playing",
  };

  start(pombo) {
    this.resizeCanvas();
    this.engineState = GenealogicTree.engineStates.LOADING;

    //load resources
    this.allImagesLoaded = () => {
      this.engineState = GenealogicTree.engineStates.PLAYING;
    };
    const sheetLoader = new SheetLoader();

    // Carrega as imagens
    pombo.canvasImage = sheetLoader.queueSheet(
      pombo.foto
        ? "" + pombo.foto
        : "https://www.policiajudiciaria.pt/wp-content/uploads/2004/04/sem-foto.jpg"
    );
    pombo.pai.canvasImage = sheetLoader.queueSheet(
      pombo.pai.foto
        ? "" + pombo.pai.foto
        : "https://www.policiajudiciaria.pt/wp-content/uploads/2004/04/sem-foto.jpg"
    );
    pombo.mae.canvasImage = sheetLoader.queueSheet(
      pombo.mae.foto
        ? "" + pombo.mae.foto
        : "https://www.policiajudiciaria.pt/wp-content/uploads/2004/04/sem-foto.jpg"
    );
    pombo.pai.pai.canvasImage = sheetLoader.queueSheet(
      pombo.pai.pai.foto
        ? "" + pombo.pai.pai.foto
        : "https://www.policiajudiciaria.pt/wp-content/uploads/2004/04/sem-foto.jpg"
    );
    pombo.pai.mae.canvasImage = sheetLoader.queueSheet(
      pombo.pai.mae.foto
        ? "" + pombo.pai.mae.foto
        : "https://www.policiajudiciaria.pt/wp-content/uploads/2004/04/sem-foto.jpg"
    );
    pombo.mae.pai.canvasImage = sheetLoader.queueSheet(
      pombo.mae.pai.foto
        ? "" + pombo.mae.pai.foto
        : "https://www.policiajudiciaria.pt/wp-content/uploads/2004/04/sem-foto.jpg"
    );
    pombo.mae.mae.canvasImage = sheetLoader.queueSheet(
      pombo.mae.mae.foto
        ? "" + pombo.mae.mae.foto
        : "https://www.policiajudiciaria.pt/wp-content/uploads/2004/04/sem-foto.jpg"
    );
    sheetLoader.loadSheetQueue(() => {
      this.allImagesLoaded();
    });
    this.sheetLoader = sheetLoader;

    this.pombo = pombo;

    this.gameLoop();
  }

  gameLoop = () => {
    console.log(this.engineState);
    window.requestAnimationFrame(() => {
      this.gameLoop();
    });

    this.render();
  };

  renderPombo(x, y, pombo, scale = 1, currentDepth = 0, maxDepth = 0) {
    let pomboRect = {
      x: x - (pombo.canvasImage.width / 2) * scale,
      y: y - (pombo.canvasImage.height / 2) * scale,
      w: pombo.canvasImage.width * scale,
      h: pombo.canvasImage.height * scale,
    };

    if (currentDepth == 0) {
      this.ctx.save();
      this.ctx.beginPath();
      this.ctx.moveTo(pomboRect.x + pomboRect.w / 2, this.canvas.height);
      this.ctx.lineWidth = 100;
      this.ctx.lineTo(
        pomboRect.x + pomboRect.w / 2,
        pomboRect.y + pomboRect.h / 2
      );
      this.ctx.stroke();
      this.ctx.restore();
    }

    scale *= 0.8;
    const xOffsetRatio = 9 / (9 + currentDepth * 5);

    if (currentDepth < maxDepth) {
      if (pombo.pai) {
        if (pombo.pai.canvasImage) {
          let paiRect = {
            x: x + pombo.pai.canvasImage.width * xOffsetRatio * scale,
            y: y - pombo.pai.canvasImage.height * scale - 64,
            w: pombo.pai.canvasImage.width * scale,
            h: pombo.pai.canvasImage.height * scale,
          };

          this.ctx.save();
          this.ctx.beginPath();
          this.ctx.moveTo(
            pomboRect.x + pomboRect.w / 2,
            pomboRect.y + pomboRect.h / 2
          );
          this.ctx.lineWidth =
            25 + (20 - 20 * (currentDepth + 2 / maxDepth / 1));
          this.ctx.lineTo(paiRect.x, paiRect.y);
          this.ctx.stroke();
          this.ctx.restore();

          this.renderPombo(
            paiRect.x,
            paiRect.y,
            pombo.pai,
            scale,
            currentDepth + 1,
            maxDepth
          );
        }
      }
      if (pombo.mae) {
        if (pombo.mae.canvasImage) {
          let maeRect = {
            x: x + pombo.mae.canvasImage.width * -xOffsetRatio * scale,
            y: y - pombo.mae.canvasImage.height * scale - 64,
            w: pombo.mae.canvasImage.width * scale,
            h: pombo.mae.canvasImage.height * scale,
          };

          this.ctx.save();
          this.ctx.beginPath();
          this.ctx.moveTo(
            pomboRect.x + pomboRect.w / 2,
            pomboRect.y + pomboRect.h / 2
          );
          this.ctx.lineWidth =
            25 + (20 - 20 * (currentDepth + 2 / maxDepth / 1));
          this.ctx.lineTo(maeRect.x, maeRect.y);
          this.ctx.stroke();
          this.ctx.restore();

          this.renderPombo(
            maeRect.x,
            maeRect.y,
            pombo.mae,
            scale,
            currentDepth + 1,
            maxDepth
          );
        }
      }
    }

    this.ctx.save();
    this.ctx.beginPath();
    this.ctx.arc(
      pomboRect.x + pomboRect.w / 2,
      pomboRect.y + pomboRect.h / 2,
      pomboRect.w * 0.5 < pomboRect.h * 0.5
        ? pomboRect.w * 0.5
        : pomboRect.h * 0.5,
      0,
      Math.PI * 2,
      true
    );
    this.ctx.closePath();
    this.ctx.clip();

    this.ctx.drawImage(
      pombo.canvasImage,
      0,
      0,
      pombo.canvasImage.width,
      pombo.canvasImage.height,
      pomboRect.x,
      pomboRect.y,
      pomboRect.w,
      pomboRect.h
    );

    this.ctx.beginPath();
    this.ctx.arc(
      pomboRect.x + pomboRect.w / 2,
      pomboRect.y + pomboRect.h / 2,
      pomboRect.w * 0.5 < pomboRect.h * 0.5
        ? pomboRect.w * 0.5
        : pomboRect.h * 0.5,
      0,
      Math.PI * 2,
      true
    );
    this.ctx.clip();
    this.ctx.lineWidth = 3;
    this.ctx.stroke();
    this.ctx.closePath();
    this.ctx.restore();
  }

  render() {
    if (this.engineState && this.ctx) {
      switch (this.engineState) {
        case GenealogicTree.engineStates.PLAYING:
          {
            this.renderPombo(
              this.canvas.width * (1 / 2),
              this.canvas.height - this.pombo.canvasImage.height / 2 - 8,
              this.pombo,
              0.5,
              0,
              5
            );
          }
          break;
      }
    }
  }
}
