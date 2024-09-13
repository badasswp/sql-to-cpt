declare namespace wp {
  interface MediaOptions {
    title: string;
    button: {
      text: string;
    };
    multiple: boolean;
    library: {
      type: string;
    }
  }

  function media(options: MediaOptions): any;
}
