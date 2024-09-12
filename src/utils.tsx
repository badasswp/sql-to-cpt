/**
 * Get Root.
 *
 * This function is responsible for returning
 * the Root Element.
 *
 * @since 1.0.0
 *
 * @param {string} id HTML Element Id.
 * @returns Promise<HTMLElement>
 */
export const getRoot = (id: string): Promise<HTMLElement> => {
  let elapsedTime = 0;
  let interval = 25;

  return new Promise((resolve, reject) => {
    const intervalId = setInterval(() => {
      elapsedTime += interval;
      const root = document.getElementById(id);

      if (root) {
        clearInterval(intervalId)
        resolve(root as HTMLElement);
      }

      if (elapsedTime > (10 * interval)) {
        clearInterval(intervalId)
        reject(new Error('Unable to get root container...'));
      }
    }, interval);
  });
}
