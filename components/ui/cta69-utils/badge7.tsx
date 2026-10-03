import React from "react";
import { cn } from "@/lib/utils";

export interface Badge7Props {
  label: string;
  className?: string;
}

export function Badge7({ label, className }: Badge7Props) {
  return (
    <div
      className={cn(
        "inline-flex items-center gap-2.5 rounded-full border border-primary/25 bg-primary/10 px-4 py-1.5 text-xs md:text-sm font-semibold text-primary backdrop-blur-md transition-all hover:bg-primary/15 shadow-sm font-sans",
        className
      )}
    >
      <span className="relative flex h-2 w-2">
        <span className="absolute inline-flex h-full w-full animate-ping rounded-full bg-primary opacity-75"></span>
        <span className="relative inline-flex h-2 w-2 rounded-full bg-primary"></span>
      </span>
      <span>{label}</span>
    </div>
  );
}

export default Badge7;
