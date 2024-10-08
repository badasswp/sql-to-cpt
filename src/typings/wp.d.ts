declare namespace wp {
  interface MediaOptions {
    title: string;
    button: {
      text: string;
    };
    multiple: boolean;
  }

  function media(options: MediaOptions): any;
}
